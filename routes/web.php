<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;

use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\WebsiteAdminMiddleware;
use App\Http\Middleware\ClientMiddleware;

use App\Livewire\Guest\Events\EventDetailsComponent;


use App\Livewire\Guest\Service\ServiceDetailsComponent;
use App\Livewire\Superadmin\SuperAdminContactComponent;
use App\Livewire\Superadmin\SuperAdminDashboardComponent;



//website admin components
use App\Livewire\WebsiteAdmin\WebsiteAdminDashbaord;
use App\Livewire\WebsiteAdmin\Services\NewServiceComponent;
use App\Livewire\WebsiteAdmin\Services\WebsiteAdminServiceComponent;
use App\Livewire\WebsiteAdmin\Services\EditServiceComponent;

use App\Livewire\WebsiteAdmin\Programs\NewProgramComponent;
use App\Livewire\WebsiteAdmin\Programs\ProgramsComponent;
use App\Livewire\WebsiteAdmin\Programs\EditProgramComponent;

use App\Livewire\WebsiteAdmin\Programfees\NewProgramFeeComponent;
use App\Livewire\WebsiteAdmin\Programfees\ProgramFeesComponent;
use App\Livewire\WebsiteAdmin\Programfees\EditProgramFeeComponent;

use App\Livewire\WebsiteAdmin\Blogs\NewBlogComponent;
use App\Livewire\WebsiteAdmin\Blogs\BlogsComponent;
use App\Livewire\WebsiteAdmin\Blogs\EditBlogComponent;

use App\Livewire\WebsiteAdmin\Events\NewEventComponent;
use App\Livewire\WebsiteAdmin\Events\WebsiteAdminEventsComponent;
use App\Livewire\WebsiteAdmin\Events\EditEventComponent;
use App\Livewire\WebsiteAdmin\Events\RegistrationDetails;

use App\Livewire\WebsiteAdmin\Sponsors\NewSponsorComponent;
use App\Livewire\WebsiteAdmin\Sponsors\SponsorsComponent;
// use App\Livewire\WebsiteAdmin\Sponsors\EditSponsorComponent;
use App\Livewire\WebsiteAdmin\Profile\ProfileComponent;
use App\Livewire\WebsiteAdmin\Profile\ChangePasswordComponent;

use App\Livewire\WebsiteAdmin\Faqs\NewFaqComponent;
use App\Livewire\WebsiteAdmin\Faqs\FaqsComponent;
use App\Livewire\WebsiteAdmin\Booking\AppointmentsComponent;

use App\Livewire\WebsiteAdmin\Newsletters\SendNewsletterComponent;
use App\Livewire\WebsiteAdmin\Newsletters\SentNewsletterComponent;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ResourceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/about', function () {
    return view('informations.about');
})->name('about');

Route::get('/contact', function () {
    return view('informations.contact');
})->name('contact');
Route::post('/contact-us',[ ContactController::class,'sendMessage'])->name('sendMessage');


Route::get('/frequently-asked-question', function () {
    $faqs = App\Models\Faq::all();
    return view('informations.faq',compact('faqs'));
})->name('faq');
Route::post('/chat', [ChatController::class, 'chat']);
Route::get('/chat', function () {
    return view('chat');
});

Route::get('/resources', [ResourceController::class, 'index'])->name('resources.all');
Route::get('/resources/videos', [ResourceController::class, 'videos'])->name('resources.videos');
Route::get('/resources/podcasts', [ResourceController::class, 'podcasts'])->name('resources.podcasts');
Route::get('/resources/books', [ResourceController::class, 'books'])->name('resources.books');
Route::get('/resources/articles', [ResourceController::class, 'articles'])->name('resources.articles');

// Appointment Routes
Route::resource('appointments', AppointmentController::class)->except(['index', 'create', 'show', 'edit']);
Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');

// Payment Routes
Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');

// Program Routes
Route::resource('programs', ProgramController::class)->except(['index', 'create', 'show', 'edit']);
Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create');
Route::get('programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');

// Service Routes
Route::resource('services', ServiceController::class)->except(['index', 'create', 'show', 'edit']);
Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::get('services-details/{service}/edit', [ServiceController::class, 'details'])->name('services.details');
Route::get('our-services', [ServiceController::class, 'our_services'])->name('services.all');
Route::post('subscriber', [NewsletterController::class, 'subscribe'])->name('subscribe');

Route::get('blog-details/{service}/details', [BlogController::class, 'details'])->name('blogs.details');
Route::get('blogs', [BlogController::class, 'all_blogs'])->name('blogs.all');

Route::get('program-details/{id}/details', [ProgramController::class, 'details'])->name('programs.details');
Route::get('programs', [ProgramController::class, 'all_programs'])->name('programs.all');


// Booking Routes
Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'bookAsGuest'])->name('booking.submit');
Route::get('/booking-success', [BookingController::class, 'bookingSuccessPage'])->name('booking.success');

// Pages route
// Route::get('/about', [PageController::class, 'about'])->name('about');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth:sanctum','verified',])->group(function () {
    Route::get('/dashboard',[ DashboardController::class,'dashboard'])->name('dashboard');

    //client routes
    Route::middleware([ClientMiddleware::class])->prefix('client')->group(function(){
        Route::get('/client-dashboard', function () {
            $bookings = App\Models\Appointment::where('user_id',Auth::user()->id)->get();
            $payments = App\Models\Payment::where('user_id',Auth::user()->id)->get();
            return view('client.client-dashboard',compact('bookings','payments'));
        })->name('client-dashboard');

        Route::get('/change-password', function () {
            return view('client.change-password');
        })->name('client.change-password');

        Route::get('/booking', function () {
            return view('client.book-consultation');
        })->name('client.book');

        Route::get('/client-bookings', function () {
            $bookings = App\Models\Appointment::where('user_id',Auth::user()->id)->get();
            return view('client.appointments',compact('bookings'));
        })->name('client.bookings');

    Route::post('/change-password',[ DashboardController::class,'changepassword'])->name('client.change-password');
    Route::get('/get-services/{id}',[ ServiceController::class,'getServices']);
    Route::get('/get-booking-price/{id}/{productID}',[ ServiceController::class,'bookingPrice']);
    Route::post('/book-appointment',[ ServiceController::class,'bookAppointment'])->name('book-appointment');

    });

    //website admin route
    Route::middleware([WebsiteAdminMiddleware::class])->prefix('website-admin')->group(function(){
        Route::get('/dashboard',WebsiteAdminDashbaord::class)->name('websiteadmin.dashboard');
        Route::get('/services/create',NewServiceComponent::class)->name('services.create');
        Route::get('/services',WebsiteAdminServiceComponent::class)->name('services.index');
        Route::get('/services/{id}/edit',EditServiceComponent::class)->name('services.edit');

        Route::get('/programs/create',NewProgramComponent::class)->name('programs.create');
        Route::get('/programs',ProgramsComponent::class)->name('programs.index');
        Route::get('/programs/{id}/edit',EditProgramComponent::class)->name('programs.edit');

        Route::get('/program-fees/create',NewProgramFeeComponent::class)->name('fees.create');
        Route::get('/program-fees',ProgramFeesComponent::class)->name('fees.index');
        Route::get('/program-program/{id}/edit',EditProgramFeeComponent::class)->name('fees.edit');

        Route::get('/blogs/create',NewBlogComponent::class)->name('blogs.create');
        Route::get('/blogs',blogsComponent::class)->name('blogs.index');
        Route::get('/blogs/{id}/edit',EditBlogComponent::class)->name('blogs.edit');

        Route::get('/events/create',NewEventComponent::class)->name('events.create');
        Route::get('/events',WebsiteAdminEventsComponent::class)->name('events.index');
        Route::get('/events/{id}/edit',EditEventComponent::class)->name('events.edit');
        Route::get('/events/{id}/registrations',RegistrationDetails::class)->name('events.registrations');

        Route::get('/sponsors/create',NewSponsorComponent::class)->name('sponsors.create');
        Route::get('/sponsors',SponsorsComponent::class)->name('sponsors.index');

        Route::get('/newsletter/snd',SendNewsletterComponent::class)->name('newsletter.send');
        Route::get('/sent-newsletter',SentNewsletterComponent::class)->name('newsletter.sent');
        Route::get('/admin-bookings',AppointmentsComponent::class)->name('admin.bookings');

        Route::get('/frequently-asked-question/create',NewFaqComponent::class)->name('faqs.create');
        Route::get('/frequently-asked-question',FaqsComponent::class)->name('faqs.index');

        Route::get('/profile',ProfileComponent::class)->name('profile');
        Route::get('/change-password',ChangePasswordComponent::class)->name('change-password');
    });
});

// Route::get('/index', function () {
//     return view('index');
// })->name('page');
// Route::get('/add-billing', function () {
//     return view('add-billing');
// })->name('add-billing');
// Route::get('/appointments', function () {
//     return view('appointments');
// })->name('appointments');
// Route::get('/blank-page', function () {
//     return view('blank-page');
// })->name('blank-page');
// Route::get('/blog-details', function () {
//     return view('blog-details');
// })->name('blog-details');
// Route::get('/blog-grid', function () {
//     return view('blog-grid');
// })->name('blog-grid');
// Route::get('/blog-list', function () {
//     return view('blog-list');
// })->name('blog-list');
// Route::get('/booking-success', function () {
//     return view('booking-success');
// })->name('booking-success');
// Route::get('/booking', function () {
//     return view('booking');
// })->name('booking');
// Route::get('/calendar', function () {
//     return view('calendar');
// })->name('calendar');

// Route::get('/chat', function () {
//     return view('chat');
// })->name('chat');
// Route::get('/checkout', function () {
//     return view('checkout');
// })->name('checkout');
// Route::get('/components', function () {
//     return view('components');
// })->name('components');
// Route::get('/favourites', function () {
//     return view('favourites');
// })->name('favourites');
// Route::get('/forgot-password', function () {
//     return view('forgot-password');
// })->name('forgot-password');
// Route::get('/invoice-view', function () {
//     return view('invoice-view');
// })->name('invoice-view');
// Route::get('/invoices', function () {
//     return view('invoices');
// })->name('invoices');
// Route::get('/login', function () {
//     return view('login');
// })->name('login');
// Route::get('/find-counselor', function () {
//     return view('map-grid');
// })->name('find-counselor');
// Route::get('/voice-call', function () {
//     return view('voice-call');
// })->name('voice-call');
// Route::get('/video-call', function () {
//     return view('video-call');
// })->name('video-call');
// Route::get('/term-condition', function () {
//     return view('term-condition');
// })->name('term-condition');
// Route::get('/social-media', function () {
//     return view('social-media');
// })->name('social-media');
// Route::get('/search', function () {
//     return view('search');
// })->name('search');
// Route::get('/schedule-timings', function () {
//     return view('schedule-timings');
// })->name('schedule-timings');
// Route::get('/reviews', function () {
//     return view('reviews');
// })->name('reviews');
// Route::get('/register', function () {
//     return view('register');
// })->name('register');
// Route::get('/profile-settings', function () {
//     return view('profile-settings');
// })->name('profile-settings');
// Route::get('/privacy-policy', function () {
//     return view('privacy-policy');
// })->name('privacy-policy');
// Route::get('/map-list', function () {
//     return view('map-list');
// })->name('map-list');
// Route::get('/add-prescription', function () {
//     return view('add-prescription');
// })->name('add-prescription');
// Route::get('/appointment-detail', function () {
//     return view('appointment-detail');
// })->name('appointment-detail');
// Route::get('/chat-councellor', function () {
//     return view('chat-councellor');
// })->name('chat-councellor');
// Route::get('/choose-service', function () {
//     return view('choose-service');
// })->name('choose-service');
// Route::get('/councellor-change-password', function () {
//     return view('councellor-change-password');
// })->name('councellor-change-password');
// Route::get('/councellor-dashboard', function () {
//     return view('councellor-dashboard');
// })->name('councellor-dashboard');
// Route::get('/councellor-profile-settings', function () {
//     return view('councellor-profile-settings');
// })->name('councellor-profile-settings');
// Route::get('/councellor-profile', function () {
//     return view('councellor-profile');
// })->name('councellor-profile');
// Route::get('/councellor-register', function () {
//     return view('councellor-register');
// })->name('councellor-register');
// Route::get('/edit-billing', function () {
//     return view('edit-billing');
// })->name('edit-billing');
// Route::get('/edit-prescription', function () {
//     return view('edit-prescription');
// })->name('edit-prescription');
// Route::get('/find-councellor', function () {
//     return view('find-councellor');
// })->name('find-councellor');
// Route::get('/health-profile', function () {
//     return view('health-profile');
// })->name('health-profile');
// Route::get('/my-account', function () {
//     return view('my-account');
// })->name('my-account');
// Route::get('/my-councellor-profile', function () {
//     return view('my-councellor-profile');
// })->name('my-councellor-profile');
// Route::get('/my-councellor', function () {
//     return view('my-councellor');
// })->name('my-councellor');
// Route::get('/my-patients', function () {
//     return view('my-patients');
// })->name('my-patients');
// Route::get('/patient-add-dependent', function () {
//     return view('patient-add-dependent');
// })->name('patient-add-dependent');
// Route::get('/patient-dashboard', function () {
//     return view('patient-dashboard');
// })->name('patient-dashboard');
// Route::get('/patient-dependent', function () {
//     return view('patient-dependent');
// })->name('patient-dependent');
// Route::get('/patient-profile', function () {
//     return view('patient-profile');
// })->name('patient-profile');
// Route::get('/select-payment', function () {
//     return view('select-payment');
// })->name('select-payment');
// Route::get('/type-of-visit', function () {
//     return view('type-of-visit');
// })->name('type-of-visit');
// Route::get('/visit-confirmed', function () {
//     return view('visit-confirmed');
// })->name('visit-confirmed');
// Route::get('/visit-question', function () {
//     return view('visit-question');
// })->name('visit-question');
// Route::get('/visit-reason', function () {
//     return view('visit-reason');
// })->name('visit-reason');

require __DIR__.'/auth.php';
