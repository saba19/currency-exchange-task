# Currency exchange


## Requirements
- composer
- php 8.2


## Installation
To install dependencies run ```composer install```. To run test use ```php bin/phpunit```.

## Introduction

Assumptions:
The following currency exchange rates exist:
- EUR -> GBP 1.5678
- GBP -> EUR 1.5432


The customer is charged a fee of 1% of the amount:
- Paid to the customer in the event of sale
- Collected from the customer in the event of purchase