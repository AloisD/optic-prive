import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
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
    private route: ActivatedRoute,
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

    const id_url = this.route.snapshot.params['id'];
    if (!id_url) {
      this.router.navigate(['404']);
    }
    if (this.authenticationService.getUserId()) {
      this.idLocalStorage = this.authenticationService.getUserId();
      if (!this.idLocalStorage) {
        this.router.navigate(['404']);
      }
      if (id_url == this.idLocalStorage) {
        authorized = true;
      }
    }

    return true;
  }

  welcome(username: string) {
    console.log('toast', username);

    this.toastService.show(`Welcome ${username}`, {
      classname: 'bg-info text-light',
      delay: 5000,
    });
  }
}
