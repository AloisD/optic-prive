import { Component, OnInit } from "@angular/core";
import { ActivatedRoute, Params, Router } from "@angular/router";
import { IUser } from "src/app/models/IUser";
import { AuthenticationService } from "src/app/services/authentication/authentication.service";
import { ToastService } from "src/app/services/toast/toast.service";

@Component({
    selector: "app-profile-page",
    templateUrl: "./profile-page.component.html",
    styleUrls: ["./profile-page.component.scss"],
})
export class ProfilePageComponent implements OnInit {
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
            this.router.navigate(["404"]);
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
        this.idLocalStorage = this.authenticationService.getUserId();
        if (!this.idLocalStorage) {
            authorized = false;
        }
        authorized = true;

        return authorized;
    }

    welcome(username: string) {
        console.log("toast", username);

        this.toastService.show(`Welcome ${username}`, {
            classname: "bg-info text-light",
            delay: 5000,
        });
    }
}
