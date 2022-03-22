import {
  HttpClient,
  HttpHeaders,
  HttpParams,
  HttpParamsOptions,
  JsonpClientBackend,
} from '@angular/common/http';
import { isPlatformBrowser } from '@angular/common';
import { Injectable, Inject, PLATFORM_ID  } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { IUser } from 'src/app/models/IUser';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {

  private messageSource = new BehaviorSubject('connexion');
  currentMessage = this.messageSource.asObservable();

  constructor(private http: HttpClient, @Inject(PLATFORM_ID) private platformId: Object) {}

  authentication(user: any) {
    return this.http.post(`${environment.apiUrl}/authentication_token`, user, {
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
    return this.http.get(`${environment.apiUrl}/api/products`, options);
  }

  me() {
    return this.http.get<any>(`${environment.apiUrl}/api/me`, {
      withCredentials: true,
    });
  }

  register(user: any) {
    return this.http.post(`${environment.apiUrl}/api/users/register`, user, {
      withCredentials: true,
    });
  }

  saveUserToLocalstorage(id: any) {
    if (isPlatformBrowser(this.platformId)) {
      localStorage.setItem('user-id', JSON.stringify(id));
    }
  }

  getUserId(): number | null {
    let userId;
    if (isPlatformBrowser(this.platformId)) {
      if (localStorage.getItem('user-id')) {
        const idString: any = localStorage.getItem('user-id');
        userId = JSON.parse(idString);
      }
    }
    return +userId;
  }

  getUser(id: number): Observable<any> {
    return this.http.get(`${environment.apiUrl}/api/users/${id}`, {
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
