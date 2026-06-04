# FeedTan Digital - Mobile App API Documentation

## Base URL

```
https://yourdomain.com/api/member
```

## Authentication

Most endpoints require an authentication token. To authenticate, include this header in your requests:

```
Authorization: Bearer <your-token>
```

---

## Public Endpoints (No Authentication Required)

### 1. Send OTP

Sends an OTP to the provided phone number.

**Endpoint:** `POST /api/member/send-otp`

**Request Body:**
```json
{
    "phone": "+255712345678"
}
```

**Response:**
```json
{
    "success": true,
    "message": "OTP sent successfully",
    "data": {
        "otp": "123456",
        "expires_at": "2024-06-04T12:34:56+00:00"
    }
}
```

---

### 2. Verify OTP

Verifies the OTP sent to the phone number.

**Endpoint:** `POST /api/member/verify-otp`

**Request Body:**
```json
{
    "phone": "+255712345678",
    "otp": "123456"
}
```

**Response:**
```json
{
    "success": true,
    "message": "OTP verified successfully"
}
```

---

### 3. Check Email

Check if an email exists in the system for login.

**Endpoint:** `POST /api/member/check-email`

**Request Body:**
```json
{
    "email": "john@example.com"
}
```

**Response (New member, needs registration):**
```json
{
    "success": false,
    "message": "Email not found in system, please register first",
    "data": {
        "needs_registration": true
    }
}
```

**Response (Existing member):**
```json
{
    "success": true,
    "message": "Email found",
    "data": {
        "needs_registration": false,
        "pin_is_set": true,
        "member": {
            "member_no": "M-2024-000001",
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+255712345678",
            "region": "Dar es Salaam",
            "branch": "Main",
            "membership_type": "Regular",
            "status": "Active",
            "joined_at": "2024-05-20T10:00:00Z",
            "passport_photo": null
        }
    }
}
```

---

### 4. Register Member

Registers a new member account.

**Endpoint:** `POST /api/member/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "phone": "+255712345678",
    "nida": "1234567890123456",
    "gender": "Male",
    "dob": "1990-01-01",
    "marital_status": "Single",
    "occupation": "Business Owner",
    "employer": "Self",
    "region": "Dar es Salaam",
    "district": "Kinondoni",
    "ward": "Mikocheni",
    "street": "Bagamoyo Road",
    "po_box": "1234",
    "branch": "Main",
    "membership_type": "Regular",
    "next_of_kin_name": "Jane Doe",
    "next_of_kin_relationship": "Sister",
    "next_of_kin_phone": "+255719876543",
    "pin": "1234"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Member registered successfully",
    "data": {
        "token": "3|mE5Lx3d13uL...",
        "member": {
            "member_no": "M-2024-000001",
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+255712345678",
            "region": "Dar es Salaam",
            "branch": "Main",
            "membership_type": "Regular",
            "status": "Active",
            "joined_at": "2024-06-04T10:00:00Z"
        }
    }
}
```

---

### 5. First Time Login

Logs in an existing member and sets a PIN.

**Endpoint:** `POST /api/member/login-first`

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123",
    "pin": "1234"
}
```

**Response:**
```json
{
    "success": true,
    "message": "PIN set and logged in successfully",
    "data": {
        "token": "3|mE5Lx3d13uL...",
        "member": {
            "member_no": "M-2024-000001",
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+255712345678",
            "region": "Dar es Salaam",
            "branch": "Main",
            "membership_type": "Regular",
            "status": "Active",
            "joined_at": "2024-05-20T10:00:00Z",
            "passport_photo": null
        }
    }
}
```

---

### 6. Login with PIN

Logs in a member using their PIN.

**Endpoint:** `POST /api/member/login-pin`

**Request Body:**
```json
{
    "email": "john@example.com",
    "pin": "1234"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Logged in successfully with PIN",
    "data": {
        "token": "3|mE5Lx3d13uL...",
        "member": {
            "member_no": "M-2024-000001",
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+255712345678",
            "region": "Dar es Salaam",
            "branch": "Main",
            "membership_type": "Regular",
            "status": "Active",
            "joined_at": "2024-05-20T10:00:00Z",
            "passport_photo": null
        }
    }
}
```

---

---

## Protected Endpoints (Requires Authentication)

---

### 7. Logout

Logs out the member and revokes the token.

**Endpoint:** `POST /api/member/logout`

**Headers:** `Authorization: Bearer <token>`

**Response:**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

---

### 8. Dashboard

Gets the dashboard overview.

**Endpoint:** `GET /api/member/dashboard`

**Headers:** `Authorization: Bearer <token>`

**Response:**
```json
{
    "success": true,
    "message": "Dashboard data retrieved successfully",
    "data": {
        "member": {
            "member_no": "M-2024-000001",
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+255712345678",
            "region": "Dar es Salaam",
            "branch": "Main",
            "membership_type": "Regular",
            "status": "Active",
            "joined_at": "2024-05-20T10:00:00Z",
            "passport_photo": null
        },
        "balances": {
            "total_savings": 500000,
            "active_loans": 300000,
            "loan_due": 50000,
            "shares": 0,
            "welfare": 0,
            "investments": 0
        },
        "recent_transactions": [...]
    }
}
```

---

### 9. Get Profile

Get member profile details.

**Endpoint:** `GET /api/member/profile`

**Headers:** `Authorization: Bearer <token>`

---

### 10. Update Profile

Update member profile information.

**Endpoint:** `POST /api/member/profile`

**Headers:** `Authorization: Bearer <token>`

**Request Body:**
```json
{
    "name": "John Doe",
    "phone": "+255712345678",
    "region": "Dar es Salaam",
    "district": "Kinondoni",
    "ward": "Mikocheni"
}
```

---

### 11. Upload Photo

Upload passport photo or NIDA card photo.

**Endpoint:** `POST /api/member/upload-photo`

**Headers:** `Authorization: Bearer <token>`

**Content-Type:** `multipart/form-data`

**Form Data:**
- `passport_photo` (image file, max 2MB)
- `nida_card` (image file, max 2MB)

---

### 12. Change PIN

Change member PIN.

**Endpoint:** `POST /api/member/change-pin`

**Headers:** `Authorization: Bearer <token>`

**Request Body:**
```json
{
    "current_pin": "1234",
    "new_pin": "4321"
}
```

---

### 13. Change Password

Change member password.

**Endpoint:** `POST /api/member/change-password`

**Headers:** `Authorization: Bearer <token>`

**Request Body:**
```json
{
    "current_password": "password123",
    "new_password": "newpassword123"
}
```

---

### 14. Get Savings Accounts

Get all member savings accounts.

**Endpoint:** `GET /api/member/savings`

**Headers:** `Authorization: Bearer <token>`

---

### 15. Get Loans

Get all member loans.

**Endpoint:** `GET /api/member/loans`

**Headers:** `Authorization: Bearer <token>`

---

### 16. Get Investments

Get all member investments.

**Endpoint:** `GET /api/member/investments`

**Headers:** `Authorization: Bearer <token>`

---

### 17. Get Transactions

Get member transaction history.

**Endpoint:** `GET /api/member/transactions?per_page=20`

**Headers:** `Authorization: Bearer <token>`

---

### 18. Get Statements

Get account statements for a date range.

**Endpoint:** `GET /api/member/statements?from_date=2024-01-01&to_date=2024-12-31`

**Headers:** `Authorization: Bearer <token>`

---

### 19. Submit KYC

Submit KYC documents for verification.

**Endpoint:** `POST /api/member/submit-kyc`

**Headers:** `Authorization: Bearer <token>`

**Content-Type:** `multipart/form-data`

**Form Data:**
- `type`: "national_id", "passport", or "driver_license"
- `document_number`: String
- `document_image`: Image file (max 5MB)
- `selfie`: Image file (optional, max 5MB)

---

### 20. Get KYC Status

Get KYC verification status.

**Endpoint:** `GET /api/member/kyc-status`

**Headers:** `Authorization: Bearer <token>`

---

## Error Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request (invalid data) |
| 401 | Unauthorized (invalid credentials or token) |
| 403 | Forbidden (account locked or inactive) |
| 404 | Not Found |
| 500 | Internal Server Error |
