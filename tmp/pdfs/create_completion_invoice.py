import sys
from pathlib import Path
sys.path.insert(0, str(Path('tmp/pdfs/python-packages').resolve()))
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, PageBreak
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib import colors
from reportlab.lib.enums import TA_LEFT
import fitz

out = Path('output/pdf'); out.mkdir(parents=True, exist_ok=True)
green = colors.HexColor('#40633B'); gold = colors.HexColor('#cda237')
styles = getSampleStyleSheet()
styles.add(ParagraphStyle(name='TitleBrand', fontName='Helvetica-Bold', fontSize=25, leading=29, textColor=green, spaceAfter=12))
styles.add(ParagraphStyle(name='SectionBrand', fontName='Helvetica-Bold', fontSize=12, leading=16, textColor=green, spaceBefore=12, spaceAfter=5))
styles.add(ParagraphStyle(name='CopyBrand', fontName='Helvetica', fontSize=10, leading=14, textColor=colors.HexColor('#344339'), spaceAfter=7))
styles.add(ParagraphStyle(name='SmallBrand', fontName='Helvetica', fontSize=9, leading=12, textColor=colors.HexColor('#58655b'), spaceAfter=6))
story=[]
def p(text, style='CopyBrand'): return Paragraph(text, styles[style])
def title(kicker, heading):
    story.extend([p(kicker, 'SmallBrand'),p(heading,'TitleBrand')])
def group(heading,text): story.extend([p(heading,'SectionBrand'),p(text)])
def footer(canvas, doc):
    canvas.setStrokeColor(gold); canvas.line(42,43,553,43)
    canvas.setFont('Helvetica',8); canvas.setFillColor(green)
    canvas.drawString(42,29,'The Way We Love | Completion record and draft invoice | 23 October 2026')
    canvas.drawRightString(553,29,str(doc.page))

title('PROJECT DELIVERY RECORD | 23 OCTOBER 2026','Completed work')
story.append(p('Project: The Way We Love application improvements. This record covers completed implementation and the validation recorded during this engagement. It does not certify that all release requirements are complete.'))
groups=[
('01 / Application review and planning','Reviewed routes, models, migrations, layouts, dependencies and tests. Prepared a prioritized improvement plan covering security, payments, booking integrity, reliability, design and deployment.'),
('02 / Authentication and authorization','Replaced unsafe custom password-reset behavior with token-validated Laravel broker flows, including legacy routes. Enforced active-account login, email verification, role restrictions and authorization on service writes and website-administration Livewire components. Added public endpoint throttles and input bounds.'),
('03 / Booking and appointment integrity','Added a shared booking/rescheduling service with calendar locking, overlapping and cross-midnight conflict checks. Repaired guest appointment persistence, booking routes and confirmation views. Calculated prices from database records; preserved appointment history on cancellation.'),
('04 / Payments and checkout','Implemented persisted order quotes and payment attempts, server-side pricing in minor units, typed Square calls and durable idempotency keys. Verified payment amount, currency, location and references before completion. Added signed webhook replay protection, uncertain-payment review handling and client payment-history persistence. Removed the public paid-booking finalizer.'),
('05 / Data relationships and catalog protection','Added relationship/type-correction migrations and orphan-reference checks. Restricted deletion of referenced catalog entries to protect history. Guided correction of empty appointment service references to NULL on the server; the client subsequently confirmed successful migration completion.'),
('06 / Routing, reliability and newsletters','Repaired missing public resource/media views and route targets, duplicate route names and DELETE-only program deletion. Bounded chat timeouts/retries and replaced exposed exception text with safe errors. Added per-recipient queued newsletter delivery tracking, retries and attachment validation.')]
for h,t in groups: group(h,t)
story.append(PageBreak())
title('PROJECT DELIVERY RECORD | CONTINUED','Design, quality and delivery')
for h,t in [
('07 / Shared design and accessibility','Retained the Cabin and Parisienne fonts and existing green, gold and sage palette. Added shared public/account/admin styling for forms, cards, tables, focus states and mobile layouts. Repaired shared document markup and assets, improved social image metadata and profile fields. Added an accessible mobile menu, skip link and reduced-motion handling.'),
('08 / Landing-page refinement','Retained the original three-slide hero, imagery and content direction. Improved hero text readability with translucent panels and added pause controls. Added pale sage section backgrounds, gold heading accents, aligned image cards, shorter program previews, a framed founder portrait, balanced spacing, accessible FAQs and a closing appointment invitation. Added missing-image fallbacks and lazy loading.'),
('09 / About page and portrait','Improved biography spacing, heading hierarchy, specialist-grid structure, vision/mission readability and contact links. Replaced the read-more interaction with accessible expandable content and removed an empty decorative section. Created a separately saved portrait edit focused on lighting and clarity, with facial-structure preservation instructions; retained the original photograph.'),
('10 / Programs, login and registration','Aligned program-card image proportions, title/preview areas, spacing and read-more buttons, with responsive columns. Refined login and registration using sage backgrounds, brand-colored form cards and clearer mobile layouts. Added linked input labels, autofill hints, password guidance and reCAPTCHA expiry handling; corrected the remember-me field name.'),
('11 / Tests, tooling and documentation','Repaired factories and registration/profile tests, forced isolated in-memory SQLite testing, and added security, booking/payment, newsletter and public-page regressions. Added application CI and corrected the Semgrep schedule. Updated setup/deployment/environment documentation. Applied compatible npm dependency fixes.'),
]: group(h,t)
group('Recorded validation','Full isolated suite: 56 tests / 408 assertions passed at the earlier implementation checkpoint. Latest authentication/public-page run: 12 tests / 33 assertions passed. Frontend build, route caching and selected desktop/mobile browser checks passed at their recorded checkpoints. Later style edits passed CSS syntax and whitespace checks. These are checkpoint results, not a new full-suite execution for this report.')
story.append(p('<b>Outstanding / excluded from completed scope:</b> PHP framework/runtime upgrades (last audit: 51 advisories across 15 packages); development-toolchain audit findings (last audit: 10); live provider/sandbox end-to-end verification; parallel MySQL booking verification; backup restoration testing; broader upload/content review; and a complete visual/accessibility audit of every authenticated screen. Server permission guidance was supplied; the subsequent migration output no longer showed the logging error.', 'SmallBrand'))
story.append(PageBreak())
title('DRAFT - NOT A PAYMENT DEMAND','Invoice')
story.append(p('Reference: TWWL-DRAFT-20261023 | Prepared: 23 October 2026'))
story.append(p('<b>Bill to:</b> The Way We Love (legal billing name/address to be confirmed)<br/><b>Supplier:</b> To be confirmed<br/><b>Currency, invoice number and payment terms:</b> To be confirmed'))
story.append(Spacer(1,12))
rows=[[p('<b>Completed service</b>'),p('<b>Amount</b>')]]
for label in ['Application review and improvement planning','Authentication, authorization and security fixes','Booking, payments and data-integrity implementation','Routing, chat and newsletter reliability fixes','Shared design and landing-page refinements','About page and portrait enhancement','Program-card and authentication-page refinements','Regression checks, CI, documentation and migration support']:
    rows.append([p(label),p('To be confirmed')])
table=Table(rows,colWidths=[370,141],hAlign='LEFT')
table.setStyle(TableStyle([('BACKGROUND',(0,0),(-1,0),colors.HexColor('#eaf0e6')),('VALIGN',(0,0),(-1,-1),'TOP'),('LEFTPADDING',(0,0),(-1,-1),12),('RIGHTPADDING',(0,0),(-1,-1),12),('TOPPADDING',(0,0),(-1,-1),9),('BOTTOMPADDING',(0,0),(-1,-1),5),('LINEBELOW',(0,0),(-1,0),1,gold),('LINEBELOW',(0,1),(-1,-1),.4,colors.HexColor('#dce3d7'))]))
story.append(table)
story.append(Spacer(1,18))
story.append(p('<b>Subtotal:</b> To be confirmed<br/><b>Tax / VAT:</b> To be confirmed<br/><b>Total:</b> To be confirmed<br/><b>Payment status:</b> Not recorded'))
story.append(p('No rates, hours, fixed fees, tax treatment or payment details were provided. Amounts are intentionally unpriced and do not represent zero charges. This draft must be completed and approved by the supplier before issue. Outstanding release work is excluded unless separately agreed.','SmallBrand'))
doc=SimpleDocTemplate(str(out/'completed-work-and-draft-invoice.pdf'),pagesize=(595.28,841.89),leftMargin=42,rightMargin=42,topMargin=40,bottomMargin=58)
doc.build(story,onFirstPage=footer,onLaterPages=footer)
pdf=fitz.open(out/'completed-work-and-draft-invoice.pdf')
for i,page in enumerate(pdf):
    page.get_pixmap(matrix=fitz.Matrix(1,1)).save(f'tmp/pdfs/completion-page-{i+1}.png')
print(f'Created {len(pdf)} pages')
for i,page in enumerate(pdf): print(f'Page {i+1}: {len(page.get_text())} text characters')
