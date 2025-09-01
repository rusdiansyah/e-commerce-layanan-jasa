<?php

use App\Livewire\BannerList;
use App\Livewire\BookingList;
use App\Livewire\BookingPayment;
use App\Livewire\Dashboard;
use App\Livewire\Favicon;
use App\Livewire\HomePage;
use App\Livewire\HomePage\CardPaketDetail;
use App\Livewire\JenisPaketFilter;
use App\Livewire\JenisPaketList;
use App\Livewire\Login;
use App\Livewire\LogoHome;
use App\Livewire\LogoLogin;
use App\Livewire\LupaPassword;
use App\Livewire\PaketEdit;
use App\Livewire\PaketList;
use App\Livewire\PaymentList;
use App\Livewire\PhotoUser;
use App\Livewire\Register;
use App\Livewire\Role;
use App\Livewire\Setting;
use App\Livewire\User;
use App\Livewire\User\BookingList as UserBookingList;
use App\Livewire\User\BookingPayment as UserBookingPayment;
use App\Livewire\User\CardPaketDetail as UserCardPaketDetail;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\PaketList as UserPaketList;
use App\Livewire\User\PaymentList as UserPaymentList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->middleware('guest')->name('homepage');
Route::get('/paket-detail/{id}', CardPaketDetail::class)->middleware('guest')->name('paket-detail');
Route::get('/jenis-paket/{id}', JenisPaketFilter::class)->middleware('guest')->name('jenis-paket');

Route::get('/login', Login::class)->middleware('guest')->name('login');
Route::get('/register', Register::class)->middleware('guest')->name('register');
Route::get('/forgot-password', LupaPassword::class)->middleware('guest')->name('forgot-password');

Route::group(['middleware' => ['auth', 'checkrole:Admin']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::get('setting/identitas', Setting::class)->name('identitas');
    Route::get('setting/favicon', Favicon::class)->name('favicon');
    Route::get('setting/logo_login', LogoLogin::class)->name('logo_login');
    Route::get('setting/logo_home', LogoHome::class)->name('logo_home');

    Route::get('user/role', Role::class)->name('role');
    Route::get('user/user', User::class)->name('user');

    Route::get('bannerList', BannerList::class)->name('bannerList');

    Route::get('produk/jenisPaketList', JenisPaketList::class)->name('produk.jenisPaketList');
    Route::get('produk/paketList', PaketList::class)->name('produk.paketList');
    Route::get('produk/paketEdit/{id}', PaketEdit::class)->name('produk.paketEdit');

    Route::get('bookingList', BookingList::class)->name('bookingList');
    Route::get('bookingPayment/{id}', BookingPayment::class)->name('bookingPayment');

    Route::get('paymentList', PaymentList::class)->name('paymentList');
});

Route::group(['middleware' => ['auth', 'checkrole:User']], function () {
    Route::get('user/dashboard', UserDashboard::class)->name('user.dashboard');


    Route::get('user/paketList',UserPaketList::class)->name('user.paketList');
    Route::get('user/bookingList',UserBookingList::class)->name('user.bookingList');
    Route::get('user/paymentList',UserPaymentList::class)->name('user.paymentList');
    Route::get('user/bookingPayment/{id}',UserBookingPayment::class)->name('user.bookingPayment');
    Route::get('user/paketDetail/{id}',UserCardPaketDetail::class)->name('user.paketDetail');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('photouser', PhotoUser::class)->name('photouser');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    // Route::get('errorPage', ErrorPage::class);
});
