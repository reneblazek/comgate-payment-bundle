## Symfony Bundle

A symfony bundle for Comgate payments

Installation
------------

### Step 1: Download MufinComgateBundle using composer

Require the `mufin/comgate-bundle` with composer [Composer](http://getcomposer.org/).

```bash
$ composer require mufin/comgate-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php

// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Mufin\ComgateBundle\MufinComgateBundle(),
        // ...
    );
}
```

### Step 3: Configure the MufinComgateBundle

Below is a minimal example of the configuration necessary to use the
`MufinComgateBundle` in your application:

```yml
# .env

###> mufin/comgate-bundle ###
MERCHANT_ID="your merchant id"
SECRET_KEY="secret key from comgate dashboard"
TEST_MODE=false
###< mufin/comgate-bundle ###
```

### Step 4: Usage of MufinComgateBundle

```php
# CartController

/**
     * @Route("/cart/payment", name="cart_payment")
     * @param ComgateConnector $comgate
     * @param Request
     * @return Response
     */
    public function payment(ComgateConnector $comgate): Response
    {
        
        $payment = new CreatePayment('PRICE', 'Your order ID', $this->getUser()->getEmail(), 'Some product');
        // to create payment on background according to API requirements
        $payment->setPrepareOnly(true);
        $response = $comgate->send($payment);
        if($response->getMessage()=="OK"){
            // do something with cart
            return $this->redirect($response->getRedirectUrl());
        }

        return $this->render('cart/payment.html.twig', []);
    }

```
