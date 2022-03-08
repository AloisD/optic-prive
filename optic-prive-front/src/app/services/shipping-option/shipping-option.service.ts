import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IShippingOption } from 'src/app/models/IShippingOption';

@Injectable({
  providedIn: 'root'
})
export class ShippingOptionService {

  public shippingPrice :number = 0;
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getShippingOptions(): Observable<IShippingOption> {
    return this.http.get<IShippingOption>(`${this.$url}/shipping_options`);
  }

  getShippingOption(id:number): Observable<IShippingOption> {
    return this.http.get<IShippingOption>(`${this.$url}/shipping_options/${id}`);
  }
}
