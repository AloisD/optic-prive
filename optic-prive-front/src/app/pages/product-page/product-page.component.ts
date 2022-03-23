import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';
import { IProduct } from 'src/app/models/IProduct';
import { ProductService } from 'src/app/services/product/product.service';
import { CartService } from 'src/app/services/cart/cart.service';
import { environment } from 'src/environments/environment';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-product-page',
  templateUrl: './product-page.component.html',
  styleUrls: ['./product-page.component.scss']
})
export class ProductPageComponent implements OnInit {

  product!: IProduct;
  apiUrl = `${environment.apiUrl}`;
  id: number | undefined;
  imagePath1: string | undefined;
  imagePath2: string | undefined;
  imagePath3: string | undefined;

  constructor(
    private activatedRoute: ActivatedRoute,
    private productService: ProductService,
    private cartService: CartService,
    private toastService: ToastService,
   ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.id = params['id'];
    });
    this.productService.getProduct(this.id!).subscribe((currentProduct: IProduct) => {
      this.product = currentProduct;
      console.log(this.product.seller.username);
      let index = 0;
      this.imagePath1 = this.product.productImages[index].path;
      index ++;
      if (this.product.productImages[index]) {
        this.imagePath2 = this.product.productImages[index].path;
        index ++;
        if (this.product.productImages[index]) {
          this.imagePath3 = this.product.productImages[index].path;
        }
      }
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
