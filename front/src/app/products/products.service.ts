import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { Product } from './product.class';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

    private static productslist: Product[] = null;
    private products$: BehaviorSubject<Product[]> = new BehaviorSubject<Product[]>([]);
    private apiUrl = 'http://127.0.0.1:8000/api';

    constructor(private http: HttpClient) { }

    getProducts(): Observable<Product[]> {
        if( ! ProductsService.productslist )
        {
            this.http.get<any>(`${this.apiUrl}/products`).subscribe(data => {
                ProductsService.productslist = data;

                this.products$.next(ProductsService.productslist);
            });
        }
        else
        {
            this.products$.next(ProductsService.productslist);
        }

        return this.products$;
    }

    create(prod: Product): Observable<Product[]> {
        this.http.post<any>(`${this.apiUrl}/products`, prod).subscribe(data => {
            ProductsService.productslist.push(data);

            this.products$.next(ProductsService.productslist);
        });

        return this.products$;
    }

    update(prod: Product): Observable<Product[]>{
        this.http.put<any>(`${this.apiUrl}/products/${prod.id}`, prod).subscribe(data => {
            ProductsService.productslist.forEach(element => {
                if(element.id == data.id)
                {
                    element.name = data.name;
                    element.category = data.category;
                    element.code = data.code;
                    element.description = data.description;
                    element.image = data.image;
                    element.inventoryStatus = data.inventoryStatus;
                    element.price = data.price;
                    element.quantity = data.quantity;
                    element.rating = data.rating;
                }
            });

            this.products$.next(ProductsService.productslist);
        });

        return this.products$;
    }

    delete(id: number): Observable<Product[]>{
        this.http.delete<any>(`${this.apiUrl}/products/${id}`).subscribe(data => {
            ProductsService.productslist = ProductsService.productslist.filter(value => value.id !== data.id);

            this.products$.next(ProductsService.productslist);
        });

        return this.products$;
    }
}
