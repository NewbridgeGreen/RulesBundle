Getting Started With RulesBundle
==================================

This bundle allows you to create customisable rules to be applied to objects based on the given conditions. The following is an example of what this bundle attempts to solve.

**Scenario**

If a **User** has not given you an email address. **Create** a **Notification** asking them to supply it.

**Creating this Rule**

``` php
$rule = new Rule;
$employee = new Employee;

// Map this rule to all employee objects
$rule->setTarget($employee);

// Check if the 'email' property is empty
$condition = new Condition;
$condition->setProperty('email')
    ->setComparator(new Empty(true));
$rule->addCondition($condition);

// If the conditions are true
$action = new Action;
$action->setClass(
    new CreateNotification(array(
        'title' => 'Please update your account with an email address',
    ))
);

$rule->addAction($action);

$ruleManager = new RuleManager($documentManager);
$ruleManager->save($rule);

```

The above example saves the **Rule** to the database. What this does is create a generic rule that will apply to any **Employee** object evaluated by the **RuleManager**

``` php
    $newEmployee = new Employee;
    $newEmployee->setEmail('');
    
    $ruleManager->evaluate($newEmployee);
```

The **RuleManager** will find all the rules that apply to this object and check the conditions of each rule to see if there are any actions to be performed again it.


// Sets the object type we want to apply this rule to
$rule->setTarget(Class|String $target);

// Sets the comparison object used to compare the given value with the expected one 
$condition->setComparator(Comparable $comparator)

$action->setClass(Actionable $class);

## Prerequisites

This version of the bundle requires Symfony 2.1+.

## Installation Steps

1. Download RulesBundle using composer
2. Enable the Bundle
3. Configure the RulesBundle

### Step 1: Download RulesBundle using composer

Add RulesBundle in your composer.json:

```js
{
    "require": {
        "newbridgegreen/rules-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update newbridgegreen/rules-bundle
```

Composer will install the bundle to your project's `vendor/newbridgegreen`

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new NewbridgeGreen\RulesBundle\NewbridgeGreenRulesBundle(),
    );
}
```


### Step 3: Configure the RulesBundle

Add the following configuration to your `config.yml` file.

``` yaml
# app/config/config.yml
# RulesBundle configuration
newbridge_green_rules:
    rule_manager:
        default_database: rules
```