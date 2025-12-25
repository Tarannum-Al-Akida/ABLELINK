<?php



use App\Http\Controllers\Caregiver\CaregiverController;
use App\Http\Controllers\Caregiver\ConnectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\AccessibilityController;
use App\Http\Controllers\DashboardController; // F2 - Rifat Jahan Roza
use App\Http\Controllers\EmergencySosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;




// Caregiver Routes


//F1 - Akida Lisi
// Auth Routes (F1)
Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login/send-otp', [LoginController::class, 'sendOtp'])->name('login.send-otp');

Route::get('/otp', [OtpController::class, 'show'])->name('otp.show');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    // F2 - Rifat Jahan Roza
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

//F4 - Farhan Zarif
Route::middleware(['auth'])->group(function () {
    
    Route::prefix('caregiver')->name('caregiver.')->group(function () {
        Route::get('/dashboard', [CaregiverController::class, 'index'])->name('dashboard');
        Route::post('/request', [CaregiverController::class, 'sendRequest'])->name('request');
        Route::get('/patient/{user}/edit', [CaregiverController::class, 'editPatient'])->name('patient.edit');
        Route::put('/patient/{user}', [CaregiverController::class, 'updatePatient'])->name('patient.update');
        Route::delete('/patient/{user}', [CaregiverController::class, 'unlink'])->name('patient.unlink');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/requests', [ConnectionController::class, 'index'])->name('requests');
        Route::post('/requests/{caregiver}/approve', [ConnectionController::class, 'approve'])->name('requests.approve');
        Route::post('/requests/{caregiver}/deny', [ConnectionController::class, 'deny'])->name('requests.deny');
    });

    //F3 - Evan Yuvraj Munshi
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar');

    // Emergency SOS (disabled users)
    Route::post('/sos', [EmergencySosController::class, 'store'])->name('sos.store');
    
    //F3 - Evan Yuvraj Munshi
    Route::get('/accessibility', [AccessibilityController::class, 'edit'])->name('accessibility.edit');
    Route::put('/accessibility', [AccessibilityController::class, 'update'])->name('accessibility.update');

});

//F1 - Akida Lisi
Route::get('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login.submit');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/sos/{event}/resolve', [EmergencySosController::class, 'resolve'])->name('admin.sos.resolve');
});

Route::get('/upload', [DocumentController::class, 'showUploadForm']);
Route::post('/upload', [DocumentController::class, 'processDocument']);
Route::post('/simplify', [DocumentController::class, 'simplifyText']);