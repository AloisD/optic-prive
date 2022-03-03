import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProduct } from 'src/app/models/IProduct';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products`);
  }

  getLatestProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products/latest`);
  }

  getProductsBySegment(segment_name: string): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products/${segment_name}`);
  }
}
