import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { IProduct } from 'src/app/models/IProduct';
import { ProductService } from 'src/app/services/product/product.service';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-product-page',
  templateUrl: './product-page.component.html',
  styleUrls: ['./product-page.component.scss']
})
export class ProductPageComponent implements OnInit {

  product! : IProduct;

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService,
    private cartService: CartService,
   ) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    this.productService.getProduct(id).subscribe(p => this.product = p);
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
  }

}
