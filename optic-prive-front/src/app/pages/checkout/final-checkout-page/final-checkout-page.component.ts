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
import { environment } from 'src/environments/environment';
import { ToastService } from 'src/app/services/toast/toast.service';
import { IProduct } from 'src/app/models/IProduct';

@Component({
  selector: 'app-final-checkout-page',
  templateUrl: './final-checkout-page.component.html',
  styleUrls: ['./final-checkout-page.component.scss'],
})
export class FinalCheckoutPageComponent implements OnInit {
  public products: any = [];
  public sellers: string[] = [];
  public shippingOption! : any;
  public apiUrl = `${environment.apiUrl}`;
  public grandTotal!: number;
  public productsQuantity!: number;
  public summaryShippingPrice!: number;
  public price!: number;
  public productToDelete: any;
  public payment: Payment = new Payment();
  public address = {
    id: -1,
    name: '',
    recipient: '',
    country: '',
    city: '',
    street: '',
    number: -1,
    firstname: '',
    lastname: '',
  };
  public isSameAddressBilling = true;
  public addresses!: IAddress[];
  public user!: any;
  public isSendPaid = false;

  @ViewChild('elemAddressClose', { static: true })
  elementAddressClose: ElementRef = <ElementRef>{};



  constructor(
    private cartService: CartService,
    private shippingOptionService: ShippingOptionService,
    private authenticationService: AuthenticationService,
    private addresseService: AddresseService,
    private toastService: ToastService,
    private paymentService: PaymentService
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

    this.getAdresses(userId);

    this.products.forEach((product: IProduct) => {
      if (!this.sellers.includes(product.seller.username)) {
       this.sellers.push(product.seller.username);
     }
   });
    this.cartService.shippingOption.subscribe((shippingOption) => {
      this.shippingOption = shippingOption;
    });
  }

  getAdresses(userId: number) {
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
    this.isSendPaid = true;
    const products = this.products;
    let shippingId = this.cartService.getShippingPriceId();
    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    let objPayement = {
      products,
      shippingId,
      userId,
      isSameAddressBilling: this.isSameAddressBilling,
      addressBillingId: this.payment.addressBillingId,
      addressDeliveryId: this.payment.addressDeliveryId,
    };

   // console.log('objPayement------------>', objPayement);

    this.paymentService.pay(objPayement).subscribe((response: any) => {
      console.log('Response:', response);
      if (response['url']) {
        console.log('url stripe :', response['url']);
        window.open(`${response['url']}`, '_blank');
      }
      this.isSendPaid = false;
    });
  }

  onCheckboxChange(e: any) {
    if (e.target.checked) {
      this.isSameAddressBilling = true;
    } else {
      this.isSameAddressBilling = false;
    }
  }

  addAddress(addressForm: NgForm) {
    console.log('addressForm', addressForm.form.value);
    let userId: number | null;
    // userId = null;
    userId = this.authenticationService.getUserId();

    if (!userId) {
      alert('Merci de vous connecter');
      return;
    }

    const newAddressBilling = {
      //     additionnalDetails: addressForm.form.value.additionnal_detailsBilling,
      name: addressForm.form.value.name,
      recipient: addressForm.form.value.name,
      city: addressForm.form.value.city,
      country: addressForm.form.value.country,
      firstname: addressForm.form.value.firstname,
      lastname: addressForm.form.value.lastname,
      user: `/api/users/${userId}`,
    };

    this.addresseService
      .createdAddress(newAddressBilling)
      .subscribe((addresse) => {
        if (userId) {
          this.createAdresseSuccess();
          this.getAdresses(userId);
        }
      });

    // For close modal
    let el = this.elementAddressClose.nativeElement; //this.elementBillingClose.nativeElement;
    el?.click();

    //delete fields from forms
    addressForm.reset();
  }

  onItemChange(address: IAddress | null = null) {
    if (address != null) {
      console.log('id adresse sélectionnée:', address.id);
      this.payment.addressBillingId = address.id;
    } else {
      console.log('Aucune adresse sélectionnée');
      this.payment.addressBillingId = -1; //
    }
  }

  onItemChangeDelivery(address: IAddress | null = null) {
    if (address != null) {
      console.log('id adresse delivery sélectionnée:', address.id);
      this.payment.addressDeliveryId = address.id;
    } else {
      console.log('Aucune adresse sélectionnée');
      this.payment.addressDeliveryId = -1; //
    }
  }

  createAdresseSuccess() {
    this.toastService.show(`L'adresse a été crée`, {
      classname: 'bg-success text-light',
      delay: 3000,
    });
  }
}
