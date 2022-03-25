import { Component, OnDestroy, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Subscription } from 'rxjs';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { CartService } from 'src/app/services/cart/cart.service';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit, OnDestroy {
  public totalProduct: number = 0;
  public productsQuantity!: number;
  message!: string;
  subscription!: Subscription;

  constructor(
    private cartService: CartService,
    private authenticationService: AuthenticationService,
    private router: Router,
    private toastService: ToastService
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      if (res) {
        this.totalProduct = res.length;
      }
      this.productsQuantity = this.cartService.getProductsQuantity();
    });

    this.subscription = this.authenticationService.currentMessage.subscribe(
      (message) => {
        this.message = message;
      }
    );
  }

  logout() {
    this.authenticationService.changeMessage('connexion');
    this.authenticationService.clearLocalStorage();
    this.logoutSuccess();
 //   this.router.navigate(['/']);
    document.location.href = '/';
  }

  goToProfile() {
    this.router.navigate(['profile']);
  }

  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }

  logoutSuccess() {
    this.toastService.show(`La déconnexion a été effectuée`, {
      classname: 'bg-success text-light',
      delay: 3000,
    });
  }
}
