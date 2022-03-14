import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Payment } from 'src/app/models/Payment';
import { CartService } from 'src/app/services/cart/cart.service';
import { PaymentService } from 'src/app/services/payment/payment.service';
import { ShippingOptionService } from 'src/app/services/shipping-option/shipping-option.service';

@Component({
  selector: 'app-final-checkout-page',
  templateUrl: './final-checkout-page.component.html',
  styleUrls: ['./final-checkout-page.component.scss'],
})
export class FinalCheckoutPageComponent implements OnInit {
  public products: any = [];
  public grandTotal!: number;
  public productsQuantity!: number;
  public summaryShippingPrice!: number;
  public price!: number;
  public productToDelete: any;
  public payment: Payment = new Payment();

  constructor(
    private cartService: CartService,
    private shippingOptionService: ShippingOptionService,
    private paymentService: PaymentService
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
      this.price = this.cartService.getPrice();
      console.log('prix', this.price);
    });
    this.setProductToDelete(this.products[0]);
  }

  changePriceShipping() {
    this.summaryShippingPrice = this.shippingOptionService.shippingPrice;
    console.log('changePriceShipping', this.summaryShippingPrice);
  }

  removeItem(product: any) {
    this.cartService.deleteCartProduct(product);
  }

  decreaseQuantity(product: any) {
    this.cartService.removeFromCart(product);
  }

  setProductToDelete(product: any) {
    this.productToDelete = product;
  }

  checkout(checkoutForm: NgForm) {
    // console.log(checkoutForm.form.value);
    const products = this.products;
    let shippingId = this.cartService.getShippingPriceId();

    const delivery = {
      additionnal_details: checkoutForm.form.value.additionnal_details,
      address_name: checkoutForm.form.value.address_name,
      city: checkoutForm.form.value.city,
      country: checkoutForm.form.value.country,
      firstname: checkoutForm.form.value.firstname,
      lastname: checkoutForm.form.value.lastname,
    };
    let objPayement = {
      delivery: delivery,
      products: products,
      shippingId: shippingId,
    };

    console.log('objPayement', objPayement);
    //let obj = JSON.parse('{ "myString": "string", "myNumber": 4 }');

    this.paymentService.pay(objPayement).subscribe((response) => {
      console.log('Response:', response);
    });
  }
}
