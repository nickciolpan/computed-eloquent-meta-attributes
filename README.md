```markdown
# Real Estate Meta Information Retrieval Guide

This guide will walk you through the process of retrieving meta information and computed values for a specific real estate record in your Laravel project.

## Step 1: Migrate and Run Seed

Initialize your database with the necessary tables and seed data by running the following commands:

```sh
php artisan migrate
php artisan db:seed
```

## Step 2: Open Artisan Tinker

Open the Artisan Tinker environment to run PHP commands interactively with the following command:

```sh
php artisan tinker
```

## Step 3: Toggle Meta to True

Within the Artisan Tinker environment, execute the following command to enable the meta information retrieval for the `RealEstate` model:

```sh
App\Models\RealEstate::toggleMeta(true);
```

## Step 4: Retrieve Real Estate Record

Now retrieve the details of a specific real estate record, including its meta information and computed values, with the following command:

```sh
App\Models\RealEstate::find(3)->toArray();
```

Inspect the returned array to see the attributes of the real estate record annotated with extra meta information and computed values, including the real value computed with the liabilities applied through the `SubtractStrategy`.

## Step 5: Review the Output

Review the output to ensure that it contains the necessary details. The real value of the real estate should reflect the applied `SubtractStrategy` on the liabilities.

## Future To-Dos

Looking forward, here are some future enhancements to consider:

### Recursively Compute All Tree Branches
Work on a feature that will recursively compute all tree branches according to their respective designated strategies to provide a detailed analysis of the real estate's value.

### Advanced Strategies with Context Information
Experiment with advanced strategies that utilize context information. For instance, you might develop a strategy that incorporates a percentage parameter to influence the computation, enabling more dynamic and flexible strategies for determining real estate values.

Thank you for following this guide. Ensure to carry out extensive testing to validate the functionality of your setup.
```
