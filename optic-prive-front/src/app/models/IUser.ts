export interface IUser {
  id: number;
  username: string;
  email: string;
  roles: string[];
  createdAt: Date;
  updatedAt: Date;
}
