import { TestBed } from '@angular/core/testing';

import { AddresseService } from './addresse.service';

describe('AddresseService', () => {
  let service: AddresseService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AddresseService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
