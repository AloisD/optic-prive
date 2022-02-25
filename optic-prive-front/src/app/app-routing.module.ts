import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CartPageComponent } from './pages/cart-page/cart-page.component';
import { LoginComponent } from './pages/checkout/login/login.component';
import { ShippingPageComponent } from './pages/checkout/shipping-page/shipping-page.component';
import { SummaryOrderPageComponent } from './pages/checkout/summary-order-page/summary-order-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';

const routes: Routes = [
  { path: '', component: HomePageComponent },
  { path: 'panier', component: CartPageComponent },
  { path: 'livraison', component: ShippingPageComponent },
  { path: 'recapitulatif', component: SummaryOrderPageComponent },
  { path: 'connexion', component: LoginComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
