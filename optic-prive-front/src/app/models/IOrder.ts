export interface IOrder {
  id: number;
  orderHasProducts: any[];
  shipping: string;
  buyer: string;
  createdAt: Date;
  updatedAt: Date;
  orderStatus: string;
  invoicingAddress: string;
  deliveryAddress: string;
}
