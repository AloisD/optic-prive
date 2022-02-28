import { Component, OnInit } from '@angular/core';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-toast-global',
  templateUrl: './toast-global.component.html',
  styleUrls: ['./toast-global.component.scss'],
})
export class ToastGlobalComponent {
  constructor(public toastService: ToastService) {}

  showSuccess() {
    this.toastService.show('I am a success toast', {
      classname: 'bg-success text-light',
      delay: 2000,
    });
  }
}
