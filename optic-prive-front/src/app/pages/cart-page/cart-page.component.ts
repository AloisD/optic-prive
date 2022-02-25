import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';


@Component({
  selector: 'app-cart-page',
  templateUrl: './cart-page.component.html',
  styleUrls: ['./cart-page.component.scss']
})
export class CartPageComponent implements OnInit {

  public products : any = [];
  public grandTotal !: number;
  public productsQuantity !: number;
  public paiement = new Array();

  constructor(private cartService : CartService) { }

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
    });
    // console.log(this.products);
  }

  removeItem(product: any){
    this.cartService.deleteCartProduct(product);
  }

  decreaseQuantity(product: any) {
    this.cartService.removeFromCart(product);
  }

  increaseQuantity(product: any) {
    this.cartService.addToCart(product);
  }

  getProductDetails() {
    this.cartService.getProducts()
    .subscribe(res=>{
      console.log(res);
      for (let index = 0; index < res.length; index++) {
        const element = res[index];
        let temp = {
          'nom': element.name,
          'quantity': element.quantityOrdered,
          'price': element.selling_price,
        };
        this.paiement.push(temp);
        console.log('temp', temp);
      }
    });
    console.log('paiement',this.paiement);

  }
}
