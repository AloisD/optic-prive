import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {

  constructor(private http: HttpClient) { }

  authentication(user:any) {
    return this.http.post('https://localhost:8000/authentication_token', user, {
      withCredentials: true
    });
  }

  products() {
    return this.http.get('https://localhost:8000/api/products', {
      withCredentials: true
    });
  }
}
