import { Component, OnInit, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html',
  styleUrls: ['./categories.component.scss']
})
export class CategoriesComponent implements OnInit {

  @Output() segment_id = new EventEmitter<number>();

  constructor() { }

  ngOnInit(): void {
  }

  setCategorie(segmentToDisplay: number) {
    this.segment_id.emit(segmentToDisplay);
  }
}
