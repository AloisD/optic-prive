import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SummaryOrderPageComponent } from './summary-order-page.component';

describe('SummaryOrderPageComponent', () => {
  let component: SummaryOrderPageComponent;
  let fixture: ComponentFixture<SummaryOrderPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SummaryOrderPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SummaryOrderPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
