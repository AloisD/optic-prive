import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Payment } from 'src/app/models/Payment';

@Injectable({
  providedIn: 'root'
})
export class PaymentService {

  constructor(private http: HttpClient) { }


  pay(payment: any) {
    return this.http.post('https://localhost:8000/payment', payment, {
      withCredentials: true,
    });
  }
}
