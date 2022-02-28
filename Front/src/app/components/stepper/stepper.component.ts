import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-stepper',
  templateUrl: './stepper.component.html',
  styleUrls: ['./stepper.component.scss'],
})
export class StepperComponent implements OnInit {
  @Input() selectedIndex = 0;
  elements = ['Panier', 'Livraison', 'Informations', 'Paiement'];
  spaces = ['0', '26', '58', '90', '90'];

  constructor() {}

  ngOnInit(): void {}
}
