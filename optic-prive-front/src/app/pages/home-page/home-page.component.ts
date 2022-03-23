import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { environment } from 'src/environments/environment';
import { reduceEachLeadingCommentRange } from 'typescript';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
})
export class HomePageComponent implements OnInit {
  public products!: [IProduct];
  public apiUrl = `${environment.apiUrl}`;
  public nextUrl!: string;
  public previousUrl!: string;

  constructor(
    private productService: ProductService,
    private cartService: CartService,
  ) {}

  ngOnInit(): void {
    this.productService.getLatestProducts().subscribe((datas: any) => {
      //console.log('datas :', datas);

      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
      // For pagination
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
    console.log('Next url', this.nextUrl);
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
