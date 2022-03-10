import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CartPageComponent } from './pages/cart-page/cart-page.component';
import { CategoryPageComponent } from './pages/category-page/category-page.component';
import { FinalCheckoutPageComponent } from './pages/checkout/final-checkout-page/final-checkout-page.component';
import { LoginComponent } from './pages/checkout/login/login.component';
import { ShippingPageComponent } from './pages/checkout/shipping-page/shipping-page.component';
import { SummaryOrderPageComponent } from './pages/checkout/summary-order-page/summary-order-page.component';
import { ConceptPageComponent } from './pages/concept-page/concept-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { LegalNoticePageComponent } from './pages/legal-notice-page/legal-notice-page.component';
import { NotFoundPageComponent } from './pages/not-found/not-found-page/not-found-page.component';
import { ProductPageComponent } from './pages/product-page/product-page.component';
import { TermsOfSalesPageComponent } from './pages/terms-of-sales-page/terms-of-sales-page.component';
import { ProfilePageComponent } from './pages/user/profile-page/profile-page.component';

const routes: Routes = [
  { path: '', component: HomePageComponent },
  { path: 'panier', component: CartPageComponent },
  { path: 'recapitulatif', component: SummaryOrderPageComponent },
  { path: 'connexion', component: LoginComponent },
  { path: 'categorie/:name', component: CategoryPageComponent },
  { path: 'produit/:id', component: ProductPageComponent },
  { path: 'livraison', component: ShippingPageComponent },
  { path: 'concept', component: ConceptPageComponent },
  { path: 'mentions-legales', component: LegalNoticePageComponent },
  { path: 'conditions-generales', component: TermsOfSalesPageComponent },
  { path: 'commande', component: FinalCheckoutPageComponent },
  { path: 'profile/:id', component: ProfilePageComponent },
  { path: '404', component: NotFoundPageComponent },
  { path: '**', redirectTo: '/404' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
