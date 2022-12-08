<!-- Technologies -->

## Technologies

* Php: after or equal 7.4 | 8.0
* Laravel | Framework: after or equal 8.75

## Description of the project.

### The project consists of 3 parts.

* #### Bond Interest Payment Dates
* #### Creating a Bond Purchase Order
* #### Bond Order Interest Payments
* #### Objects (Bond and Order)

### Api Description

1. Bond Interest Payment Dates

* method: Get
* url : /bond/{ id }/payouts
* param: ( Int ) bond_id

2. Creating a Bond Purchase Order

* method: Post
* url : /bond/{ id }/order
* param: ( date Y-m-d ) order_date | ( Int ) number_received

3. Bond Order Interest Payments

* method: Get
* url : /bond/order/{ order_id }
* param: ( Int ) order_id

###### Example route :

  ```sh
  http://127.0.0.1:8000/api/v1/bond/1/payouts
  ```


