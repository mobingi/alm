 - mobingi-RBAC is strong Role based access control for mobingiALM.
 - this can manage user roles and access control, filtering data.

## 1. Getting Started

### Create Roles

 - Create role is managed by masteruser only.
 - This action work throught API and UI.
 - Editing role is easy. and future end-user will be able to check role permission.

### Attach Role to SubUser

 - Role works on subUser and attached by masteruser.
 - Now, subUser has single role only.
 - Future, RBAC support attatching many roles. This support manage roles easily.

### subUser Usage

 - End-user use subUser account, then mobingiALM control view data throught RBAC.
 - And some single action(ex. updateStack, deleteStack...) is rejected by role details.
