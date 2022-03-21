import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CartService } from 'src/app/services/cart/cart.service';
import { ShippingOptionService } from 'src/app/services/shipping-option/shipping-option.service';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';

@Component({
  selector: 'app-summary-order-page',
  templateUrl: './summary-order-page.component.html',
  styleUrls: ['./summary-order-page.component.scss'],
})
export class SummaryOrderPageComponent implements OnInit {
  public products: any = [];
  public grandTotal!: number;
  public productsQuantity!: number;
  public summaryShippingPrice!: number;
  public price!: number;

  constructor(
    private cartService: CartService,
    private shippingOptionService: ShippingOptionService,
    private router: Router,
    private authenticationService: AuthenticationService
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
      this.price = this.cartService.getPrice();
      console.log('prix', this.price);
    });
    console.log('cartProducts', this.cartService.cartProducts);
  }

  changePriceShipping() {
    this.summaryShippingPrice = this.shippingOptionService.shippingPrice;
  }

  nextStep() {
    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    if (!userId) {
      alert('Merci de vous connecter');
      return;
    }
    this.router.navigate(['commande']);
  }
}
