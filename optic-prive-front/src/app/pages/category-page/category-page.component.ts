import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { ActivatedRoute, Params } from '@angular/router';
import { environment } from 'src/environments/environment';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-category-page',
  templateUrl: './category-page.component.html',
  styleUrls: ['./category-page.component.scss']
})
export class CategoryPageComponent implements OnInit {
  products!: [IProduct];
  apiUrl = `${environment.apiUrl}`;
  segmentName: string | undefined;
  segmentTitle!: string;

  constructor(
    private activatedRoute: ActivatedRoute,
    private productService: ProductService,
    private cartService: CartService,
    private toastService: ToastService,
  ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.segmentName = params['name'];
      switch(this.segmentName) {
        case 'solaires':
          this.segmentTitle = 'Solaires';
          break;
        case 'sport':
          this.segmentTitle = 'Sport';
          break;
        case 'lumiere_bleue':
          this.segmentTitle = 'Lumière bleue';
          break;
        case 'vintage':
          this.segmentTitle = 'Vintage';
          break;
        case 'accessoires':
          this.segmentTitle = 'Accessoires';
          break;
      }

      this.productService.getProductsBySegment(this.segmentName).subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
       });
      });
    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
    this.toastService.show(`Votre article a bien été ajouté au panier`, {
      delay: 3000,
      classname: 'bg-success text-light'
    });
  }
}
