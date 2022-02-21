import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, Observable } from 'rxjs';
import { IProduct } from 'src/app/models/IProduct';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private $url = 'https://127.0.0.1:8000/api';
  constructor(private http: HttpClient) {}

  getProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products`)
    .pipe(map((res:any)=>{
      console.log(res);
      return res;
    }))
  }
}
