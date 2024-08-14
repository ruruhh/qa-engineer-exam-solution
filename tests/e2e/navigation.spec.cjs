const { test, expect } = require('@playwright/test');

test('user can navigate between routes', async ({ page }) => {
    await page.goto('/login');
    await page.getByPlaceholder('Email').fill('admin@example.com');
    await page.getByPlaceholder('Password').fill('password');
    await page.getByText('Sign In').click();

    await expect(page).toHaveURL(/product/);

    await page.locator('div.sidebar').getByText('Create').click();
    await page.getByText('Create').click();
    await expect(page).toHaveURL(/product\/form/);

    await page.getByText('Videos').click();
    await expect(page).toHaveURL(/videos/);

    await page.getByText('List').click();
    await expect(page).toHaveURL(/product/);
});

