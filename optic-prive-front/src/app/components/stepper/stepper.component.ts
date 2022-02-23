import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-stepper',
  templateUrl: './stepper.component.html',
  styleUrls: ['./stepper.component.scss']
})
export class StepperComponent implements OnInit {
 @Input() selectedIndex=0;
 elements = ["Panier", "Livraison", "Connexion", "Paiement"];
 spaces = ["0","26", "60", "90","90"];

  constructor() { }

  ngOnInit(): void {
  }

}
