import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { ToastService } from 'src/app/services/toast/toast.service';
import { reduceEachLeadingCommentRange } from 'typescript';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
})
export class HomePageComponent implements OnInit {
  public products!: [IProduct];

  constructor(
    private productService: ProductService,
    private cartService: CartService,
    private toastService: ToastService,
  ) {}

  ngOnInit(): void {
    this.productService.getLatestProducts().subscribe((datas: any) => {
      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
    this.toastService.show(`Votre article a bien été ajouté au panier`, {
      delay: 3000,
      classname: 'bg-success text-light',
    });
  }
}
