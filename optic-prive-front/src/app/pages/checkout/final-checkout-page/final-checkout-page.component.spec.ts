import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FinalCheckoutPageComponent } from './final-checkout-page.component';

describe('FinalCheckoutPageComponent', () => {
  let component: FinalCheckoutPageComponent;
  let fixture: ComponentFixture<FinalCheckoutPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FinalCheckoutPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FinalCheckoutPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
