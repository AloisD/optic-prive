import {
  HttpClient,
  HttpHeaders,
  HttpParams,
  HttpParamsOptions,
  JsonpClientBackend,
} from '@angular/common/http';
import { isPlatformBrowser } from '@angular/common';
import { Injectable, Inject, PLATFORM_ID  } from '@angular/core';
import { Observable } from 'rxjs';
import { IUser } from 'src/app/models/IUser';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  constructor(private http: HttpClient, @Inject(PLATFORM_ID) private platformId: Object) {}

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
    return this.http.get(`https://localhost:8000/api/users/${id}`, {
      withCredentials: true,
    });
  }
}
