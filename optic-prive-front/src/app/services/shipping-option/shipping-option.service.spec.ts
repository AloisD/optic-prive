import { TestBed } from '@angular/core/testing';

import { ShippingOptionService } from './shipping-option.service';

describe('ShippingOptionService', () => {
  let service: ShippingOptionService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ShippingOptionService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
