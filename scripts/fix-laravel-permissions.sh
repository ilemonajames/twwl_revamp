#!/usr/bin/env bash
set -euo pipefail

# Usage: sudo bash scripts/fix-laravel-permissions.sh DEPLOY_USER [PHP_GROUP] [APP_PATH]
# PHP_GROUP must be the group used by the PHP-FPM/Apache application worker.
deploy_user="${1:-${SUDO_USER:-}}"
php_group="${2:-www-data}"
app_path="${3:-/var/www/html/twwl_new}"

if [[ "$EUID" -ne 0 ]]; then
    echo "Run with sudo; see the usage comment at the top of this script." >&2
    exit 1
fi
if [[ -z "$deploy_user" || "$deploy_user" == root ]]; then
    echo "Supply the non-root deployment account as the first argument." >&2
    exit 1
fi
id "$deploy_user" >/dev/null
getent group "$php_group" >/dev/null
app_path="$(realpath -e -- "$app_path")"
if [[ "$app_path" == / || ! -f "$app_path/artisan" || ! -f "$app_path/bootstrap/app.php" ]]; then
    echo "APP_PATH must point to the Laravel application directory." >&2
    exit 1
fi

# Verify both destinations before changing anything. Refuse symlinked trees so
# recursive ownership changes cannot escape the intended application directory.
for relative in storage bootstrap/cache; do
    target="$app_path/$relative"
    if [[ ! -d "$target" || "$(realpath -e -- "$target")" != "$target" ]]; then
        echo "Expected a real directory within the application: $target" >&2
        exit 1
    fi
    if [[ -n "$(find "$target" -type l -print -quit)" ]]; then
        echo "Symlink found in $target; review its destination before applying permissions." >&2
        exit 1
    fi
done

mkdir -p -- "$app_path/storage/logs" "$app_path/storage/framework/cache/data" \
    "$app_path/storage/framework/sessions" "$app_path/storage/framework/views"

for relative in storage bootstrap/cache; do
    target="$app_path/$relative"
    chown -R -- "$deploy_user:$php_group" "$target"
    find "$target" -type d -exec chmod 2770 {} +
    find "$target" -type f -exec chmod 0660 {} +
done

echo "Permissions updated for storage and bootstrap/cache."
echo "Owner: $deploy_user; PHP worker group: $php_group"
echo "Run Artisan as $deploy_user, without sudo."
echo "If access is still denied, check the actual PHP worker group and SELinux/AppArmor policy."
