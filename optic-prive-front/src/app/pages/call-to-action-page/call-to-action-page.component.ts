import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';

@Component({
  selector: 'app-call-to-action-page',
  templateUrl: './call-to-action-page.component.html',
  styleUrls: ['./call-to-action-page.component.scss']
})
export class CallToActionPageComponent implements OnInit {
  public products!: [IProduct];
  public nextUrl!: string;
  public previousUrl!: string;

  constructor(
    private productService: ProductService,
    private cartService: CartService,
  ) {}

  ngOnInit(): void {
    this.productService.getTopDeals().subscribe((datas: any) => {
      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
       // // For pagination
       this.nextUrl = datas['hydra:view']['hydra:next'];
       this.previousUrl = datas['hydra:view']['hydra:previous'];
    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
  }

  goToPreviousPage() {
    this.productService
      .getLatestProductsByUrl(this.previousUrl)
      .subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
        });

        // For pagination
        this.nextUrl = datas['hydra:view']['hydra:next'];
        this.previousUrl = datas['hydra:view']['hydra:previous'];
      });
  }

  goToNextPage() {
    this.productService
      .getLatestProductsByUrl(this.nextUrl)
      .subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
        });

        // For pagination
        this.nextUrl = datas['hydra:view']['hydra:next'];
        this.previousUrl = datas['hydra:view']['hydra:previous'];
      });
  }
}
