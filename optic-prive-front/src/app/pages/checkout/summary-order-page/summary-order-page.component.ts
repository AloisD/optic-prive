import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { CartService } from 'src/app/services/cart/cart.service';
import { ShippingOptionService } from 'src/app/services/shipping-option/shipping-option.service';
import { IProduct } from 'src/app/models/IProduct';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';

@Component({
  selector: 'app-summary-order-page',
  templateUrl: './summary-order-page.component.html',
  styleUrls: ['./summary-order-page.component.scss'],
})
export class SummaryOrderPageComponent implements OnInit {
  public products : IProduct[] = [];
  public shippingOption! : any;
  public grandTotal !: number;
  public productsQuantity !: number;
  public summaryShippingPrice !:number;
  public price !:number;  // nom de variable pas clair : c'est le prix de quoi ?
  public sellers: string[] = [];

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
    });

    this.products.forEach((product: IProduct) => {
       if (!this.sellers.includes(product.seller.username)) {
        this.sellers.push(product.seller.username);
      }
    });
    //this.price = this.cartService.shippingOption.value.
    this.cartService.shippingOption.subscribe((shippingOption) => {
      this.shippingOption = shippingOption;
    });
  }

  changePriceShipping() {
    this.summaryShippingPrice = this.shippingOptionService.shippingPrice;
  }

  nextStep() {
    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    if (!userId) {
      let buttonLogin: HTMLElement = document.getElementById('js-login-open') as HTMLElement;
      buttonLogin.click();

      return;
    }
    this.router.navigate(['commande']);
  }
}
