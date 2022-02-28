import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { BannerComponent } from './components/banner/banner.component';
import { CategoriesComponent } from './components/categories/categories.component';
import { FooterComponent } from './components/footer/footer.component';
import { HeaderComponent } from './components/header/header.component';
import { LoginModalComponent } from './components/login-modal/login-modal.component';
import { LogoComponent } from './components/logo/logo.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { StepperComponent } from './components/stepper/stepper.component';
import { CartPageComponent } from './pages/cart-page/cart-page.component';
import { LoginComponent } from './pages/checkout/login/login.component';
import { ShippingPageComponent } from './pages/checkout/shipping-page/shipping-page.component';
import { SummaryOrderPageComponent } from './pages/checkout/summary-order-page/summary-order-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { ProductPageComponent } from './pages/product-page/product-page.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { ToastGlobalComponent } from './components/toast-global/toast-global/toast-global.component';
import { ToastsContainerComponent } from './components/toast-global/toast-global/toasts-container.component';

@NgModule({
  declarations: [
    AppComponent,
    BannerComponent,
    CategoriesComponent,
    FooterComponent,
    HeaderComponent,
    LoginModalComponent,
    LogoComponent,
    NavbarComponent,
    StepperComponent,
    CartPageComponent,
    LoginComponent,
    ShippingPageComponent,
    SummaryOrderPageComponent,
    HomePageComponent,
    ProductPageComponent,
    ToastGlobalComponent,
    ToastsContainerComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    HttpClientModule,
    FormsModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}