import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { IAddress } from 'src/app/models/IAddress';
import { Payment } from 'src/app/models/Payment';
import { AddresseService } from 'src/app/services/addresse/addresse.service';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
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
  public billing: Payment = new Payment();
  public isSameAddressBilling = true;
  public addresses!: IAddress[];
  public user!: any;

  @ViewChild('elemBillingClose', { static: true })
  elementBillingClose: ElementRef = <ElementRef>{};

  constructor(
    private cartService: CartService,
    private shippingOptionService: ShippingOptionService,
    private paymentService: PaymentService,
    private authenticationService: AuthenticationService,
    private addresseService: AddresseService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
      this.price = this.cartService.getPrice();
      //  console.log('prix', this.price);
    });
    this.setProductToDelete(this.products[0]);

    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    if (!userId) {
      alert('Merci de vous connecter');
      return;
    }

    this.getAdressess(userId);
  }

  getAdressess(userId: number) {
    this.addresseService
      .getAddressesByUser(userId)
      .subscribe((addresses: any) => {
        this.addresses = addresses['hydra:member'];
      });
  }

  changePriceShipping() {
    this.summaryShippingPrice = this.shippingOptionService.shippingPrice;
    //  console.log('changePriceShipping', this.summaryShippingPrice);
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
    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    if (!userId) {
      alert('Merci de vous connecter');
      return;
    }
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
      userId,
    };

    this.paymentService.pay(objPayement).subscribe((response: any) => {
      console.log('Response:', response);
      if (response['url']) {
        console.log('url stripe :', response['url']);
        window.open(`${response['url']}`, '_blank');
      }
    });
  }

  onCheckboxChange(e: any) {
    if (e.target.checked) {
      this.isSameAddressBilling = true;
    } else {
      this.isSameAddressBilling = false;
    }
  }

  addAddress(billingForm: NgForm) {
    console.log('BillingForm', billingForm.form.value);

    // For close modal
    let el = this.elementBillingClose.nativeElement; //this.elementBillingClose.nativeElement;
    el?.click();

    //delete fields from forms
    billingForm.reset();
  }
}
