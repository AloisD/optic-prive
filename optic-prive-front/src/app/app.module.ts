import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { BannerComponent } from './components/banner/banner.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { CartPageComponent } from './pages/cart-page/cart-page.component';
import { FormsModule } from '@angular/forms';
import { RegistrationPageComponent } from './pages/registration-page/registration-page.component';


export function createTranslateLoader(httpClient: HttpClient) {
  return new TranslateHttpLoader(httpClient, './assets/i18n/','.json')
}

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    BannerComponent,
    HomePageComponent,
    NavbarComponent,
    CartPageComponent,
    RegistrationPageComponent,
  ],

  imports: [
    BrowserModule,
    AppRoutingModule,
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: (createTranslateLoader),
        deps: [HttpClient]
      }
    }),
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
