import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { IUser } from 'src/app/models/IUser';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { User } from 'src/app/models/User';
import { CartService } from 'src/app/services/cart/cart.service';
import { ToastService } from 'src/app/services/toast/toast.service';
import { NgForm } from '@angular/forms';
import { switchMap } from 'rxjs/operators';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login-modal',
  templateUrl: './login-modal.component.html',
  styleUrls: ['./login-modal.component.scss'],
})
export class LoginModalComponent implements OnInit {
  public user = {
    email: '',
    password: '8888',
  };
  public checkRules = {
    rules: false,
  };
  public userConnected!: IUser;
  model: User = new User();
  public totalProduct: number = 0;
  public productsQuantity!: number;

  //for close register modal
  @ViewChild('elemRegisterClose', { static: true }) elementClose: ElementRef = <
    ElementRef
  >{};

  @ViewChild('elemLoginClose', { static: true }) elementLoginClose: ElementRef =
    <ElementRef>{};

  constructor(
    private authenticationService: AuthenticationService,
    private cartService: CartService,
    private toastService: ToastService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      if (res) {
        this.totalProduct = res.length;
      }
      this.productsQuantity = this.cartService.getProductsQuantity();
    });

    this.authenticationService.products();
  }

  login(loginForm: NgForm) {
    let authFlow = this.authenticationService
      .authentication(this.user)
      .pipe(switchMap(() => this.authenticationService.me()));

    authFlow.subscribe(
      (responseMe) => {
        this.userConnected = responseMe;

        if (this.userConnected) {
          //localStorage
          this.authenticationService.saveUserToLocalstorage(
            this.userConnected.id
          );

          // For close modal
          let elLogin = this.elementLoginClose.nativeElement;
          elLogin?.click();

          //clear fields's form
          loginForm.reset();

          this.connexionSuccess();

          // send message to header component
          this.authenticationService.changeMessage('logout');

          //   this.router.navigate(['profile']);
        }
      },
      (err) => {
        console.error('Error: ', err);
        this.showDanger();
      }
    );
  }

  onSubmit() {
    console.log(this.model);
  }

  saveDatas(registerForm: NgForm) {
    this.authenticationService.register(this.model).subscribe(
      () => {
        this.registerSuccess();

        // For close modal
        let el = this.elementClose.nativeElement;
        el?.click();

        //clear fields's form
        registerForm.reset();
      },
      (err) => {
        console.error('Error: ', err);
        this.registerFailed();
      }
    );
  }

  connexionSuccess() {
    this.toastService.show(`La connexion a été effectuée`, {
      classname: 'bg-success text-light',
      delay: 3000,
    });
  }

  showDanger() {
    this.toastService.show('La connexion a échouée', {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }

  registerSuccess() {
    this.toastService.show(`Inscription effectuée`, {
      classname: 'bg-success text-light',
      delay: 5000,
    });
  }

  registerFailed() {
    this.toastService.show(`Inscription non-effectuée`, {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }
}
