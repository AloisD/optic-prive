import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
//import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
//import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { BannerComponent } from './components/banner/banner.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { CartPageComponent } from './pages/cart-page/cart-page.component';
import { FormsModule } from '@angular/forms';
import { ShippingPageComponent } from './pages/checkout/shipping-page/shipping-page.component';
import { StepperComponent } from './components/stepper/stepper.component';
import { CategoriesComponent } from './components/categories/categories.component';
import { LoginModalComponent } from './components/login-modal/login-modal.component';
import { ProductPageComponent } from './pages/product-page/product-page.component';
import { LogoComponent } from './components/logo/logo.component';
import { SummaryOrderPageComponent } from './pages/checkout/summary-order-page/summary-order-page.component';
import { LoginComponent } from './pages/checkout/login/login.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ToastsContainer } from './components/toast/toasts-container.components';
import { ConceptPageComponent } from './pages/concept-page/concept-page.component';
import { LegalNoticePageComponent } from './pages/legal-notice-page/legal-notice-page.component';
import { TermsOfSalesPageComponent } from './pages/terms-of-sales-page/terms-of-sales-page.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    BannerComponent,
    HomePageComponent,
    NavbarComponent,
    CartPageComponent,
    ShippingPageComponent,
    StepperComponent,
    CategoriesComponent,
    LoginModalComponent,
    LogoComponent,
    SummaryOrderPageComponent,
    LoginComponent,
    ProductPageComponent,
    ToastsContainer,
    ConceptPageComponent,
    LegalNoticePageComponent,
    TermsOfSalesPageComponent,
  ],

  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    NgbModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
