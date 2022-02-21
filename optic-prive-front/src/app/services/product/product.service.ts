import { HttpClient, HttpHeaders } from '@angular/common/http';
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
    let httpHeaders = new HttpHeaders({
      'Content-Type': 'application/json',
      Accept: 'application/json',
    });

    let options = {
      headers: httpHeaders,
    };
    return this.http.get<IProduct>(`${this.$url}/products`);
  }
}
