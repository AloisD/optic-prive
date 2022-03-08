import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { IUser } from 'src/app/models/IUser';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-profil-page',
  templateUrl: './profil-page.component.html',
  styleUrls: ['./profil-page.component.scss'],
})
export class ProfilPageComponent implements OnInit {
  public userRecover!: any;
  public userFromBDD!: IUser;
  private idLocalStorage!: number | null;

  constructor(
    private activatedRoute: ActivatedRoute,
    private authenticationService: AuthenticationService,
    private router: Router,
    private toastService: ToastService
  ) {}

  ngOnInit(): void {
    if (!this.isAuthorized()) {
      this.router.navigate(['404']);
    } else {
      if (this.idLocalStorage) {
        this.authenticationService
          .getUser(this.idLocalStorage)
          .subscribe((user: IUser) => {
            this.userFromBDD = user;
            this.welcome(this.userFromBDD.username);
          });
      }
    }
  }

  isAuthorized(): boolean {
    let authorized = false;
    let id_url!: number;

    this.activatedRoute.params.subscribe((params: Params) => {
      id_url = params['id'];
    });

    if (!id_url) {
      authorized = false;
    }
    if (this.authenticationService.getUserId()) {
      this.idLocalStorage = this.authenticationService.getUserId();
      if (!this.idLocalStorage) {
        authorized = false;
      }
      if (id_url == this.idLocalStorage) {
        authorized = true;
      }
    }

    return authorized;
  }

  welcome(username: string) {
    console.log('toast', username);

    this.toastService.show(`Welcome ${username}`, {
      classname: 'bg-info text-light',
      delay: 5000,
    });
  }
}
