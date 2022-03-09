export interface IProduct {
  id: number;
  name: string;
  reference: string;
  color_code: string;
  retail_price: number;
  selling_price: number;
  quantity: number;
  eye_size: number;
  bridge_size: number;
  temple_length: number;
  created_at: Date;
  updated_at: Date;
  state: string;
  category: string;
  uv_protection: string;
  productImages: [any];
  segment: {
    name: string;
  };
  brand: {
    name: string;
  };
  color: {
    name: string;
  };
  material: {
    name: string;
  };
  style: {
    name: string;
  };
  shape: {
    name: string;
  };
  lens_type: {
    name: string;
  };
  seller: {
    email: string;
  };
}
