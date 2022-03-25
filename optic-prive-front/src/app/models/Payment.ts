import { IAddress } from "./IAddress";
import { IShippingOption } from "./IShippingOption";

export class Payment {
  cart: any;
  address_id!: number;
  address_name!: string;
  country!: string;
  city!: string;
  street!: string;
  number!: number;
  firstname!: string;
  lastname!: string;
  address!: IAddress;
  additionnal_details!: string;
  zip_code!: string;
  shipping_option!: IShippingOption;
  addressBillingId = -1
  addressDeliveryId = -1;
}
