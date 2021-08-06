<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Route;

Route::post('/ajax/change-lang', [\App\Http\Controllers\Ajax\TranslationController::class, 'changeLang'])->name('ajax.change.lang');

Route::get('/', [\App\Http\Controllers\Customer\MainController::class, 'index'])->name('customer.main');
Route::get('/aboutus', [\App\Http\Controllers\Customer\AboutUsController::class, 'index'])->name('customer.aboutus');
Route::get('/documents', [\App\Http\Controllers\Customer\DocumentsController::class, 'index'])->name('customer.documents');
Route::get('/investors', [\App\Http\Controllers\Customer\InvestorsController::class, 'index'])->name('customer.investors');
Route::get('/partners', [\App\Http\Controllers\Customer\PartnersController::class, 'index'])->name('customer.partners');
Route::get('/contact', [\App\Http\Controllers\Customer\ContactController::class, 'index'])->name('customer.contact');
Route::get('/payout', [\App\Http\Controllers\Customer\PayoutController::class, 'index'])->name('customer.payout');

Route::get('/support', [\App\Http\Controllers\Customer\SupportController::class, 'index'])->name('customer.support');
Route::post('/support', [\App\Http\Controllers\Customer\SupportController::class, 'send'])->name('customer.support');

Route::get('/faq', [\App\Http\Controllers\Customer\FaqController::class, 'index'])->name('customer.faq');
Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewsController::class, 'index'])->name('customer.reviews');
Route::get('/agreement', [\App\Http\Controllers\Customer\AgreementController::class, 'index'])->name('customer.agreement');

// Technical
Route::get('/partner/{partner_id}', [\App\Http\Controllers\SetPartnerController::class, 'index'])->name('partner');
Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'index'])->name('set.lang');

// Instant Payment Notifications (IPN)
Route::post('/perfectmoney/status', [\App\Http\Controllers\Payment\PerfectMoneyController::class, 'index'])->name('perfectmoney.status');
