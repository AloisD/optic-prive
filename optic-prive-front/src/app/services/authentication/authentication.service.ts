import {
  HttpClient,
  HttpHeaders,
  HttpParams,
  HttpParamsOptions,
  JsonpClientBackend,
} from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { IUser } from 'src/app/models/IUser';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  private messageSource = new BehaviorSubject('connexion');
  currentMessage = this.messageSource.asObservable();

  constructor(private http: HttpClient) {}

  authentication(user: any) {
    return this.http.post('https://localhost:8000/authentication_token', user, {
      withCredentials: true,
    });
  }

  products() {
    let httpHeaders = new HttpHeaders({
      'Content-Type': 'application/json',
      Accept: 'application/json',
    });

    let options = {
      headers: httpHeaders,
    };
    return this.http.get('https://localhost:8000/api/products', options);
  }

  me() {
    return this.http.get<any>('https://localhost:8000/api/me', {
      withCredentials: true,
    });
  }

  register(user: any) {
    return this.http.post('https://localhost:8000/api/users/register', user, {
      withCredentials: true,
    });
  }

  saveUserToLocalstorage(id: any) {
    localStorage.setItem('user-id', JSON.stringify(id));
  }

  getUserId(): number | null {
    let userId;
    if (localStorage.getItem('user-id')) {
      const idString: any = localStorage.getItem('user-id');
      userId = JSON.parse(idString);
    }
    return +userId;
  }

  getUser(id: number): Observable<any> {
    return this.http.get(`https://localhost:8000/api/users/${id}`, {
      withCredentials: true,
    });
  }

  changeMessage(message: string) {
    this.messageSource.next(message);
  }

  clearLocalStorage() {
    localStorage.removeItem('user-id');
    localStorage.removeItem('cart');
    localStorage.removeItem('shipping-price');
  }

  update(userId: any, user: any) {
    return this.http.put(`https://localhost:8000/api/users/${userId}`, user, {
      withCredentials: true,
    });
  }
}
